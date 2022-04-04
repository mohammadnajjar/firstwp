import { normalizeCondition, matchValuesWithCondition } from 'match-conditions'

export const capitalizeFirstLetter = str => {
	str = str == null ? '' : String(str)
	return str.charAt(0).toUpperCase() + str.slice(1)
}

export const getOptionLabelFor = ({ id, option, values, renderingConfig }) => {
	let maybeLabel =
		Object.keys(option).indexOf('label') === -1
			? capitalizeFirstLetter(id).replace(/\_|\-/g, ' ')
			: option.label

	if (maybeLabel !== maybeLabel.toString()) {
		maybeLabel =
			Object.keys(maybeLabel).reduce((approvedLabel, currentLabel) => {
				if (approvedLabel) {
					return approvedLabel
				}

				if (
					matchValuesWithCondition(
						normalizeCondition(maybeLabel[currentLabel]),
						values
					)
				) {
					return currentLabel
				}

				return approvedLabel
			}, null) || Object.keys(maybeLabel)[0]
	}

	if (maybeLabel === '') {
		maybeLabel = true
	}

	if (renderingConfig && !renderingConfig.label) {
		maybeLabel = false
	}

	return maybeLabel
}

export const cssBoxShadow = (v) => {
	if (v.enable === true) {
		return (v.inset ? 'inset' : '') + ' ' + v.h_offset + 'px ' + v.v_offset + 'px ' + v.blur + 'px ' + v.spread + 'px ' + v.color.color + ';'
	} else {
		return false;
	}
}

export const fontWeightVariation = (variation) => {
	var fontType = variation.split("")
	var fontWeight = fontType[1] * 100
	return fontWeight
}

export const fontStyle = (variation) => {
	var variationType = variation.split("")
	var font = variationType[0] === 'n' ? 'normal' : variationType[0] === 'i' ? 'italic' : 'Default'
	return font
}
